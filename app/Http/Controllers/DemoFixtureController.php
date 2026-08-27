<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableFixtureRequest;
use App\Http\Requests\TreeFixtureRequest;
use App\Support\FileMapFixtures;
use Illuminate\Http\JsonResponse;

final class DemoFixtureController extends Controller
{
    public function show(string $fixture, TreeFixtureRequest $request): JsonResponse
    {
        if ($fixture === 'tree') {
            return $this->tree($request);
        }

        $fixtureData = match ($fixture) {
            'forms' => FileMapFixtures::formsParity(),
            'tree' => FileMapFixtures::treeParity(),
            'blueprint' => FileMapFixtures::blueprint(),
            'file-preview' => FileMapFixtures::filePreviews(),
            'map' => FileMapFixtures::map(),
        };

        return response()->json([...$fixtureData, 'scenarios' => FileMapFixtures::scenarios($fixture)]);
    }

    public function table(TableFixtureRequest $request): JsonResponse
    {
        return response()->json([...FileMapFixtures::tablePage($request->validated()), 'scenarios' => FileMapFixtures::scenarios('table')]);
    }

    public function unavailableTable(): JsonResponse
    {
        return response()->json(['message' => 'The deterministic table source is unavailable.'], 503);
    }

    private function tree(TreeFixtureRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (($validated['parent'] ?? null) === 'media') {
            return response()->json(['items' => [
                ['id' => 'office-plan', 'label' => 'office-plan.png'],
                ['id' => 'editorial-brief', 'label' => 'editorial-brief.docx'],
            ]]);
        }

        if (($validated['query'] ?? '') !== '') {
            $query = mb_strtolower($validated['query']);
            $items = array_filter(FileMapFixtures::treeParity()['items'], static fn (array $item): bool => str_contains(mb_strtolower($item['label']), $query));

            return response()->json(['items' => array_values($items)]);
        }

        return response()->json([...FileMapFixtures::treeParity(), 'scenarios' => FileMapFixtures::scenarios('tree')]);
    }
}
