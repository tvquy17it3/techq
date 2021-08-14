<?php

namespace App\Repositories\Post;


interface PostRepositoryInterface
{
     public function findById($id);
     public function publish($post);
     public function unpublish($post);
     public function store($request);
     public function update($post,$request);
     public function delete($post);
     public function search_post_unpublish($keyword);
     public function search_post_published($keyword);
     public function status_report_post($id);

}