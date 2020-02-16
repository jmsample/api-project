<?php

namespace JournalMedia\Sample\Helpers;
/*
 * e.g. you can have some template
 * $templateString = 'Hi {$who}.
 * and fill it with your data .
 * $data = array("who" => "Nancy");
 */

class TemplateHelper
{
    /**
     * render template
     */
    public static function renderTemplate($template, $placeholderArray)
    {

        $placeholderKeys = array_keys($placeholderArray);
        $subject = $template;
        foreach ($placeholderKeys as $placeholderKey) {
            $placeholderValue = $placeholderArray[$placeholderKey];
            $pattern = '/\{\$' . $placeholderKey . '\}/';
            $replace = $placeholderValue;
            $subject = preg_replace($pattern,
                TemplateHelper::preg_escape_back($replace), $subject);
        }
        return $subject;
    }

    public static function preg_escape_back($string)
    {
        // Replace $ with \$ and \ with \\
        $string = preg_replace('#(?<!\\\\)(\\$|\\\\)#', '\\\\$1', $string);
        return $string;
    }
}