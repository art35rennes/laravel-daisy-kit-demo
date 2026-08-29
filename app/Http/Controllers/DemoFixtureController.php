<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapWmsFixtureRequest;
use App\Http\Requests\TableFixtureRequest;
use App\Http\Requests\TreeFixtureRequest;
use App\Support\FileMapFixtures;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class DemoFixtureController extends Controller
{
    public function filePreview(string $fixture): Response
    {
        $contentTypes = [
            'editorial-brief.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'office-plan.svg' => 'image/svg+xml',
            'preview-walkthrough.mp4' => 'video/mp4',
            'preview.wav' => 'audio/wav',
            'quarterly-report.txt' => 'text/plain; charset=UTF-8',
            'release-notes.pdf' => 'application/pdf',
        ];

        abort_unless(isset($contentTypes[$fixture]), 404);

        $path = public_path('fixtures/'.$fixture);
        $contents = file_get_contents($path);

        abort_unless($contents !== false, 404);

        return response($contents, 200, [
            'Content-Length' => (string) filesize($path),
            'Content-Type' => $contentTypes[$fixture],
        ]);
    }

    public function show(string $fixture): JsonResponse
    {
        $fixtureData = match ($fixture) {
            'forms' => FileMapFixtures::formsParity(),
            'blueprint' => FileMapFixtures::blueprint(),
            'file-preview' => FileMapFixtures::filePreviews(),
            'map' => FileMapFixtures::map(),
        };

        return $this->fixtureResponse($fixture, $fixtureData);
    }

    public function table(TableFixtureRequest $request): JsonResponse
    {
        return $this->fixtureResponse('table', FileMapFixtures::tablePage($request->validated()));
    }

    public function unavailableTable(): JsonResponse
    {
        return response()->json(['message' => 'The deterministic table source is unavailable.'], 503);
    }

    public function mapDistricts(): JsonResponse
    {
        return response()->json(FileMapFixtures::mapDistricts(), headers: ['Content-Type' => 'application/geo+json']);
    }

    public function mapTile(string $style, string $z, string $x, string $y): Response
    {
        return response(FileMapFixtures::mapTile($style, (int) $z, (int) $x, (int) $y), 200, [
            'Cache-Control' => 'public, max-age=3600',
            'Content-Type' => 'image/svg+xml; charset=UTF-8',
        ]);
    }

    public function mapWms(MapWmsFixtureRequest $request): Response
    {
        $request->validated();

        return response(FileMapFixtures::transparentMapTile(), 200, ['Content-Type' => 'image/png']);
    }

    public function unavailableMapLayer(): JsonResponse
    {
        return response()->json(['message' => 'The deterministic map layer is unavailable.'], 503);
    }

    public function tree(TreeFixtureRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (($validated['parent'] ?? null) === 'media') {
            return response()->json(['items' => FileMapFixtures::mediaTreeItems()]);
        }

        if (($validated['query'] ?? '') !== '') {
            return response()->json(['items' => FileMapFixtures::searchTreeItems($validated['query'])]);
        }

        return $this->fixtureResponse('tree', FileMapFixtures::treeParity());
    }

    /**
     * @param  array<string, mixed>  $fixtureData
     */
    private function fixtureResponse(string $fixture, array $fixtureData): JsonResponse
    {
        return response()->json([...$fixtureData, 'scenarios' => FileMapFixtures::scenarios($fixture)]);
    }
}
