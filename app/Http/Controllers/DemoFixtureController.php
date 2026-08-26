<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableFixtureRequest;
use App\Support\FileMapFixtures;
use Illuminate\Http\JsonResponse;

final class DemoFixtureController extends Controller
{
    public function show(string $fixture): JsonResponse
    {
        return response()->json(match ($fixture) {
            'forms' => FileMapFixtures::formsParity(),
            'tree' => FileMapFixtures::treeParity(),
            'blueprint' => FileMapFixtures::blueprint(),
            'file-preview' => FileMapFixtures::filePreviews(),
            'map' => FileMapFixtures::map(),
        });
    }

    public function table(TableFixtureRequest $request): JsonResponse
    {
        return response()->json(FileMapFixtures::tablePage($request->validated()));
    }
}
