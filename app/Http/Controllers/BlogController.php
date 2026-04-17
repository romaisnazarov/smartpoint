<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use App\Repository\BlogRepository;
use App\Services\BlogService;
use Illuminate\Http\JsonResponse;
use App\Jobs\MonitorBlogJobs;

class BlogController extends Controller
{
    public function __construct(
        public BlogRepository $blogRepository,
        public BlogService $blogService
    )
    {}

    /**
     * @param BlogStoreRequest $request
     * @return JsonResponse
     */
    public function create(BlogStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $existingBlog = $this->blogRepository->getByResourceIdAndExternalId($validated['resource_id'], $validated['external_id']);
        if ($existingBlog) {
            return response()->json([
                'error' => 'Блог уже находится на мониторинге'
            ], 409);
        }

        $newBlog = $this->blogRepository->create($validated);

        MonitorBlogJobs::dispatch($newBlog);

        return response()->json([
            'message' => 'Блог успешно добавлен на мониторинг',
            'data' => $newBlog
        ], 201);
    }
}
