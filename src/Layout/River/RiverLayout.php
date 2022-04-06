<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Layout\River;

/**
 * Parent class for River layout
 */
class RiverLayout
{
    protected final function layout( string $title, array | null $data, callable $format ) : string
    {
        if( $data )
        {
            $html = array_reduce( $data, 
                function( string $carry, $item ) use ( $format )
                {
                    if( $item->type === "post" ) 
                    {
                        $title  = $item->title;
                        $exerpt = $item->excerpt;
                        $image  = $item->images->thumbnail->image;
                        $carry .= $format( $title, $exerpt, $image );
                    }
                    return $carry;
                }, 
                "" );
                
            return "<h1>{$title}</h1>{$html}"; 
        }
        return "";
    }
}
