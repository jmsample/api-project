
## Overview
This app renders a view of different rivers (i.e. articles) pulled from 
TheJournal's sandbox API. Filtering is available by tags and, in production mode,
by the publication as well.

This project uses TheJournal's [project-api](https://github.com/jmsample/api-project) framework.

## Installation 
`composer install`

## Routes

The available routes are:
- [GET] `/` - the app's entry point, which renders a general river of 
articles from a specific publication  
- [GET] `/:tag` - a view that renders a river for a specific tag
- [GET]`/articles` - an internal API call that fetches articles

Example project URLs:  
`http://localhost/the-journal/`  
`http://localhost/the-journal/google`

## Folder Structure

-[project-folder]/  
    |- src/  
        |- .htaccess - enables accessing the project without 'public/index.php'  
        |- resources - static files  
            |- demo-responses - sample JSON files for the demo mode  
            |- views - the project's views  
        |- src/ - the app's source files  
        |- Application/ - classes with the app's core logic
        |- Http/ - classes related to routing 
           |-Controller/ - the app's controlelrs
    |- public/ 
        |- index.php - the project's entry point  
        |- .htaccess - enables accessing the project without 'public/index.php'
        |- css/ - CSS files
        |- js/ - JS files 
    |- logs/ - error log files
    

