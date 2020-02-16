<?php

namespace JournalMedia\Sample\Repository;

class ArticleRepository
{
    public function transformArticleData(array $article):array {
        //image
        if(isset($article['images']['medium']['image'])){
            $articleImage=$article['images']['medium']['image'];
        }else{
            $articleImage=$article['images']['thumbnail']['image'];
        }

        if (!empty($article['title']))
            $articleTitle=$article['title'];
        else
            $articleTitle="Coming Soon!";

        $data=array(
            'title'=>$articleTitle,
            'excerpt'=>$article['excerpt'],
            'image'=>$articleImage,
        );
        return $data;
    }
}