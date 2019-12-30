<?php
namespace JournalMedia\Sample\Classes;
use JournalMedia\Sample\Interfaces\DataProviderInterface;
use JournalMedia\Sample\Model\Article;

Class StaticContentProvider implements DataProviderInterface 
{
    const fileDir = __DIR__.'/../../resources/demo-responses/';
    
    public function getByPublication(string $publication)
    {
        return $this->getData($publication);
    }

    public function getByTag(string $tag)
    {
        $data = $this->getData($tag);
        return $data;
    }

    private function getData(string $fileName) {
        try {
            $filePath = self::fileDir.$fileName.'.json';
            if (!file_exists($filePath)) {
                throw new \Exception('File data not found');
            }
            $fileContentJSON = json_decode(file_get_contents($filePath));
            $articles = [];
            foreach ($fileContentJSON as $article) {
                if ($article->type === 'post') {
                    $articles[] = new Article(  $article->title,
                                                $article->excerpt,
                                                $article->images->thumbnail->image);
                }
            }
            return $articles;
        } catch (\Exception $e) {
            return [];
        }
    }
}