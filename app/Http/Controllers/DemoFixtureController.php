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
    public function audio(): Response
    {
        $sampleRate = 8_000;
        $samples = str_repeat(pack('v', 0), $sampleRate);
        $header = 'RIFF'.pack('V', 36 + strlen($samples)).'WAVEfmt '.pack('VvvVVvv', 16, 1, 1, $sampleRate, $sampleRate * 2, 2, 16);

        return response($header.'data'.pack('V', strlen($samples)).$samples, 200, ['Content-Type' => 'audio/wav']);
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

    public function mapTile(string $z, string $x, string $y): Response
    {
        return response(FileMapFixtures::mapTile((int) $z, (int) $x, (int) $y), 200, [
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
