<?php

namespace JournalMedia\Sample\ApiProject\Transformer;

class HtmlTransformer
{
    public function outputTransformer(array $content = []) : string
    {
        $finalOutput = '';
        $output = '';
        foreach ($content['response'] as $item) {
            foreach ($item as $article) {
                if (isset($article['type']) && $article['type'] === 'post') {
                    $output = '<tr><td>Type:'.$article['type'].'</td></tr>';
                    $output .= '<tr><td>Title:'.$article['title'].'</td></tr>';
                    $output .= '<tr><td>Excerpt:'.$article['excerpt'].'</td></tr>';
                    $output .= '<tr><td>Image Medium:<img src="' . $article['images']['medium']['image'] . '"></td></tr>';

                    if (isset($article['images']['large']['image'])) {
                        $output .= '<tr><td>Image Large:<img src="' . $article['images']['large']['image'] . '"></td></tr>';
                    }

                    $finalOutput .= $output;
                }
            }
        }

        return '<table>'.$finalOutput.'</table>';
    }
}