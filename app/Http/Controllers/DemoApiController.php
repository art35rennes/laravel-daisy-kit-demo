<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DemoApiController extends Controller
{
    public function tableUsers(Request $request): JsonResponse
    {
        $rows = collect([
            ['id' => 1, 'name' => 'Cy Ganderton', 'email' => 'cy@example.com', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Hart Hagerty', 'email' => 'hart@example.com', 'status' => 'Invited'],
            ['id' => 3, 'name' => 'Brice Swyre', 'email' => 'brice@example.com', 'status' => 'Archived'],
            ['id' => 4, 'name' => 'Jolie Winters', 'email' => 'jolie@example.com', 'status' => 'Active'],
            ['id' => 5, 'name' => 'Nico Bernard', 'email' => 'nico@example.com', 'status' => 'Invited'],
            ['id' => 6, 'name' => 'Lina Carter', 'email' => 'lina@example.com', 'status' => 'Archived'],
            ['id' => 7, 'name' => 'Mia Holmes', 'email' => 'mia@example.com', 'status' => 'Active'],
            ['id' => 8, 'name' => 'Theo Bishop', 'email' => 'theo@example.com', 'status' => 'Invited'],
            ['id' => 9, 'name' => 'Emma Stone', 'email' => 'emma@example.com', 'status' => 'Active'],
            ['id' => 10, 'name' => 'Lucas Ford', 'email' => 'lucas@example.com', 'status' => 'Archived'],
            ['id' => 11, 'name' => 'Nina Ross', 'email' => 'nina@example.com', 'status' => 'Active'],
            ['id' => 12, 'name' => 'Owen Reed', 'email' => 'owen@example.com', 'status' => 'Invited'],
        ]);

        $pageIndex = max(0, (int) $request->integer('pageIndex', 0));
        $pageSize = max(1, (int) $request->integer('pageSize', 10));
        $search = trim((string) $request->input('globalFilter', ''));
        $sorting = json_decode((string) $request->input('sorting', '[]'), true);
        $columnFilters = json_decode((string) $request->input('columnFilters', '[]'), true);
        $sorting = is_array($sorting) ? $sorting : [];
        $columnFilters = is_array($columnFilters) ? $columnFilters : [];
        $sortEntry = $sorting[0] ?? null;
        $sortKey = is_array($sortEntry) ? ($sortEntry['id'] ?? null) : null;
        $sortDirection = is_array($sortEntry) && ($sortEntry['desc'] ?? false) === true ? 'desc' : 'asc';

        if ($search !== '') {
            $normalizedSearch = mb_strtolower($search);
            $rows = $rows->filter(function (array $row) use ($normalizedSearch): bool {
                foreach (['name', 'email', 'status'] as $key) {
                    if (str_contains(mb_strtolower((string) $row[$key]), $normalizedSearch)) {
                        return true;
                    }
                }

                return false;
            })->values();
        }

        foreach ($columnFilters as $filter) {
            if (! is_array($filter) || ! is_string($filter['id'] ?? null)) {
                continue;
            }

            $filterId = $filter['id'];
            $filterValue = $filter['value'] ?? null;

            $rows = match ($filterId) {
                'status' => filled($filterValue)
                    ? $rows->filter(fn (array $row): bool => strcasecmp((string) $row['status'], (string) $filterValue) === 0)->values()
                    : $rows,
                'email_domain' => filled($filterValue)
                    ? $rows->filter(fn (array $row): bool => str_ends_with(mb_strtolower((string) $row['email']), '@'.mb_strtolower((string) $filterValue)))->values()
                    : $rows,
                'active_only' => filter_var($filterValue, FILTER_VALIDATE_BOOLEAN)
                    ? $rows->filter(fn (array $row): bool => strcasecmp((string) $row['status'], 'Active') === 0)->values()
                    : $rows,
                default => $rows,
            };
        }

        $rowCount = $rows->count();

        if (is_string($sortKey) && in_array($sortKey, ['name', 'email', 'status'], true)) {
            $rows = $rows
                ->sortBy($sortKey, SORT_NATURAL | SORT_FLAG_CASE, $sortDirection === 'desc')
                ->values();
        }

        $pageRows = $rows->slice($pageIndex * $pageSize, $pageSize)->values()->all();
        $pageCount = max(1, (int) ceil($rowCount / $pageSize));

        return response()->json([
            'rows' => $pageRows,
            'rowCount' => $rowCount,
            'pageCount' => $pageCount,
            'state' => [
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
            ],
        ]);
    }

    public function datatableUsers(Request $request): JsonResponse
    {
        return $this->tableUsers($request);
    }

    public function calendarEvents(Request $request): JsonResponse
    {
        $start = new \DateTime((string) $request->query('start', date('Y-m-01')));
        $end = new \DateTime((string) $request->query('end', date('Y-m-t')));

        $events = [];
        $cur = clone $start;

        while ($cur < $end) {
            $day = (int) $cur->format('j');

            if (in_array($day, [1, 7, 12, 14, 28], true)) {
                $iso = $cur->format('Y-m-d');

                if ($day === 1) {
                    $events[] = ['id' => "a-$iso", 'title' => 'All Day Event', 'start' => $iso, 'allDay' => true];
                }

                if ($day === 12) {
                    $events[] = ['id' => "m1-$iso", 'title' => 'Meeting', 'start' => "$iso 10:30", 'end' => "$iso 12:30"];
                }

                if ($day === 14) {
                    $events[] = ['id' => "b-$iso", 'title' => 'Birthday Party', 'start' => "$iso 07:00"];
                }

                if ($day === 28) {
                    $events[] = ['id' => "g-$iso", 'title' => 'Click for Google', 'start' => $iso, 'url' => 'https://google.com'];
                }

                if ($day === 7) {
                    $events[] = ['id' => "long-$iso", 'title' => 'Long Event', 'start' => $iso, 'end' => $cur->modify('+7 day')->format('Y-m-d')];
                }
            }

            $cur->modify('+1 day');
        }

        return response()->json($events);
    }

    public function treeChildren(Request $request): JsonResponse
    {
        $node = (string) $request->query('node', '');

        $data = match ($node) {
            'b' => [
                ['id' => 'b1', 'label' => 'Fichier B1'],
                ['id' => 'b2', 'label' => 'Dossier B2 (lazy, disabled)', 'lazy' => true, 'disabled' => true],
                ['id' => 'b3', 'label' => 'Fichier B3'],
            ],
            'b2' => [
                ['id' => 'b2-1', 'label' => 'Fichier B2-1'],
                ['id' => 'b2-2', 'label' => 'Dossier B2-2 (lazy)', 'lazy' => true],
            ],
            'b2-2' => [
                ['id' => 'b2-2-1', 'label' => 'Fichier B2-2-1'],
                ['id' => 'b2-2-2', 'label' => 'Fichier B2-2-2'],
            ],
            'root' => [
                ['id' => 'r1', 'label' => 'Fichier Racine 1'],
                ['id' => 'r2', 'label' => 'Fichier Racine 2'],
            ],
            default => [
                ['id' => $node.'-1', 'label' => 'Fichier '.$node.'-1'],
                ['id' => $node.'-2', 'label' => 'Fichier '.$node.'-2'],
            ],
        };

        return response()->json($data);
    }

    public function treeSearch(Request $request): JsonResponse
    {
        $q = strtolower((string) $request->query('q', ''));

        $data = [
            ['id' => 'root', 'label' => 'Racine', 'children' => [
                ['id' => 'a', 'label' => 'Dossier A', 'children' => [
                    ['id' => 'a1', 'label' => 'Fichier A1'],
                    ['id' => 'a2', 'label' => 'Fichier A2'],
                ]],
                ['id' => 'b', 'label' => 'Dossier B (lazy)', 'children' => [
                    ['id' => 'b1', 'label' => 'Fichier B1'],
                    ['id' => 'b2', 'label' => 'Dossier B2 (lazy, disabled)', 'children' => [
                        ['id' => 'b2-1', 'label' => 'Fichier B2-1'],
                        ['id' => 'b2-2', 'label' => 'Dossier B2-2 (lazy)', 'children' => [
                            ['id' => 'b2-2-1', 'label' => 'Fichier B2-2-1'],
                            ['id' => 'b2-2-2', 'label' => 'Fichier B2-2-2'],
                        ]],
                    ]],
                ]],
                ['id' => 'c', 'label' => 'Fichier C'],
            ]],
        ];

        $paths = [];
        $cur = [];

        $walk = function ($nodes) use (&$walk, &$paths, &$cur, $q) {
            foreach ($nodes as $n) {
                $cur[] = $n['id'];
                $label = strtolower((string) ($n['label'] ?? (string) $n['id']));

                if ($q !== '' && (str_contains($label, $q) || str_contains(strtolower((string) $n['id']), $q))) {
                    $paths[] = $cur;
                }

                $children = $n['children'] ?? [];

                if (! empty($children)) {
                    $walk($children);
                }

                array_pop($cur);
            }
        };

        $walk($data);
        $paths = array_slice($paths, 0, 50);

        return response()->json(['paths' => $paths]);
    }

    public function selectOptions(Request $request): JsonResponse
    {
        $q = strtolower((string) $request->query('q', ''));

        $pool = [
            ['value' => 'alpha', 'label' => 'Alpha'],
            ['value' => 'alpine', 'label' => 'Alpine'],
            ['value' => 'beta', 'label' => 'Beta'],
            ['value' => 'bravo', 'label' => 'Bravo'],
            ['value' => 'charlie', 'label' => 'Charlie'],
            ['value' => 'delta', 'label' => 'Delta'],
            ['value' => 'echo', 'label' => 'Echo'],
            ['value' => 'foxtrot', 'label' => 'Foxtrot'],
            ['value' => 'golf', 'label' => 'Golf'],
            ['value' => 'hotel', 'label' => 'Hotel'],
            ['value' => 'india', 'label' => 'India'],
            ['value' => 'juliet', 'label' => 'Juliet'],
            ['value' => 'kilo', 'label' => 'Kilo'],
            ['value' => 'lima', 'label' => 'Lima'],
            ['value' => 'mike', 'label' => 'Mike'],
            ['value' => 'november', 'label' => 'November'],
            ['value' => 'oscar', 'label' => 'Oscar'],
            ['value' => 'papa', 'label' => 'Papa'],
            ['value' => 'quebec', 'label' => 'Quebec'],
            ['value' => 'romeo', 'label' => 'Romeo'],
            ['value' => 'sierra', 'label' => 'Sierra'],
            ['value' => 'tango', 'label' => 'Tango'],
            ['value' => 'uniform', 'label' => 'Uniform'],
            ['value' => 'victor', 'label' => 'Victor'],
            ['value' => 'whiskey', 'label' => 'Whiskey'],
            ['value' => 'xray', 'label' => 'X-Ray'],
            ['value' => 'yankee', 'label' => 'Yankee'],
            ['value' => 'zulu', 'label' => 'Zulu'],
        ];

        $contacts = [
            ['value' => 'c_john', 'label' => 'John Carter', 'subtitle' => 'john.carter@example.com', 'avatar' => '/img/people/people-1.jpg'],
            ['value' => 'c_jane', 'label' => 'Jane Doe', 'subtitle' => 'jane.doe@example.com', 'avatar' => '/img/people/people-2.jpg'],
            ['value' => 'c_alex', 'label' => 'Alex Martin', 'subtitle' => 'alex.martin@example.com', 'avatar' => '/img/people/people-3.jpg'],
            ['value' => 'c_sara', 'label' => 'Sara Kim', 'subtitle' => 'sara.kim@example.com', 'avatar' => '/img/people/people-4.jpg'],
            ['value' => 'c_luc', 'label' => 'Luc Bernard', 'subtitle' => 'luc.bernard@example.com', 'avatar' => '/img/people/people-5.jpg'],
        ];

        if (str_starts_with((string) $request->query('q', ''), '@')) {
            $groups = [
                ['title' => 'Contacts', 'items' => $contacts],
                ['title' => 'Mots', 'items' => array_slice($pool, 0, 8)],
            ];

            return response()->json([
                'groups' => $groups,
                'meta' => ['more' => 0],
            ]);
        }

        $items = [];

        foreach (array_merge($contacts, $pool) as $item) {
            $label = strtolower((string) ($item['label'] ?? ''));
            $value = strtolower((string) ($item['value'] ?? ''));
            $subtitle = strtolower((string) ($item['subtitle'] ?? ''));

            if ($q === '' || str_contains($label, $q) || str_contains($value, $q) || ($subtitle !== '' && str_contains($subtitle, $q))) {
                $items[] = $item;
            }
        }

        $limit = 10;
        $more = max(0, count($items) - $limit);
        $items = array_slice($items, 0, $limit);

        return response()->json([
            'items' => $items,
            'meta' => ['more' => $more],
        ]);
    }

    public function chatSend(Request $request): JsonResponse
    {
        $conversationId = $request->input('conversation_id', 1);
        $content = $request->input('content', '');
        $files = $request->file('files', []);
        $file = $request->file('file');

        $message = [
            'id' => rand(100, 999),
            'user_id' => 1,
            'user_name' => 'Moi',
            'user_avatar' => 'https://www.placeholderimage.eu/api/id/4/200/200',
            'content' => $content,
            'created_at' => now()->toDateTimeString(),
        ];

        if ($file || ! empty($files)) {
            $attachments = [];
            $fileList = $file ? [$file] : $files;

            foreach ($fileList as $index => $f) {
                $attachments[] = [
                    'url' => 'https://www.placeholderimage.eu/api/id/'.(20 + $index).'/400/300',
                    'name' => $f->getClientOriginalName(),
                    'type' => str_starts_with($f->getMimeType(), 'image/') ? 'image' : 'other',
                    'size' => round($f->getSize() / 1024, 1).' KB',
                ];
            }

            if (count($attachments) === 1) {
                $message['attachment'] = $attachments[0];
            } else {
                $message['attachments'] = $attachments;
            }
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function chatTyping(Request $request): JsonResponse
    {
        return response()->json(['success' => true]);
    }

    public function chatMessages(string $conversationId): JsonResponse
    {
        $messages = [
            [
                'id' => 1,
                'user_id' => 2,
                'user_name' => 'Alice Martin',
                'user_avatar' => 'https://www.placeholderimage.eu/api/id/1/200/200',
                'content' => 'Salut ! Comment allez-vous ?',
                'created_at' => now()->subMinutes(30)->toDateTimeString(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'user_name' => 'Moi',
                'user_avatar' => 'https://www.placeholderimage.eu/api/id/4/200/200',
                'content' => 'Très bien, merci ! Et vous ?',
                'created_at' => now()->subMinutes(25)->toDateTimeString(),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }
}
