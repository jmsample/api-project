<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Layout\River;

use JournalMedia\Sample\ApiProject\Layout\River\RiverLayout;

/**
 * Layout class for Publication
 */
final class PublicationRiverLayout extends RiverLayout
{
    public function layoutPublication( array | null $data ) : string
    {
        return $this->layout( "Publication", $data, function( $title, $exerpt, $image ) : string
        {
            return  "<div>" .
                        "<h2>{$title}</h2>" .
                        "<p>{$exerpt}</p>" .
                        "<figure><img src={$image}></figure>" .
                    "</div>";
        });
    }
}
