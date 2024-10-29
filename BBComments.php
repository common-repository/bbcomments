<?php
/*
Plugin Name: BBComments
Plugin URI: http://www.biggle.de/blog/bbcode-in-den-kommentaren-wordpress-plugin
Description: Make BBCodes for UserComments. FAQ: http://www.biggle.de/blog/bbcode-in-den-kommentaren-wordpress-plugin
Version: 0.2
Author: Mario Priebe
Author URI: http://www.biggle.de
*/
function render_comment($comment) {    
    
    $comment = strip_tags($comment); #entfernt kompletten htmlcode aus den Kommentar
    
    //Fontstyle
    $comment = preg_replace('/\[b\](.*?)\[\/b\]/','<strong>$1</strong>',$comment);
    $comment = preg_replace('/\[u\](.*?)\[\/u\]/','<u>$1</u>',$comment);
    $comment = preg_replace('/\[i\](.*?)\[\/i\]/','<i>$1</i>',$comment);        
    $comment = preg_replace('/\[color=(.*?)\](.*?)\[\/color\]/','<span style="color: #$1">$2</span>',$comment);
    
    //Aufzaehlung    
    $comment = eregi_replace('\[ul\]','<ul>',$comment);
    $comment = eregi_replace('\[/ul\]','</ul>',$comment);    
    $comment = preg_replace('/\[li\](.*?)\[\/li\]/','<li>$1</li>',$comment);
        
    //verweise / bilder
    $comment = preg_replace('/\[url=(.*?)\](.*?)\[\/url\]/','<a target="_blank" href="$1" title="$2">$2</a>',$comment);
    $comment = preg_replace('/\[img=(.*?)\]\[\/img\]/','<img src="$1" width="400px" height="270px" />',$comment);

    //code - wp-syntax required
    $comment = preg_replace('/\[code\](.*?)\[\/code\]/','<pre lang="csharp" line="1">$1</pre>',$comment);
    $comment = preg_replace('/\[code lang="(.*?)"\](.*?)\[\/code\]/','<pre lang="$1" line="1">$2</pre>',$comment);
             
        
    return $comment;
}

//code - wp-syntax required
function render_comment_code($comment) {

    $comment = preg_replace('/\[code\](.*?)\[\/code\]/','<pre lang="csharp" line="1">$1</pre>',$comment);
    $comment = preg_replace('/\[code lang="(.*?)"\](.*?)\[\/code\]/','<pre lang="$1" line="1">$2</pre>',$comment);
  
 return $comment; 
}

add_action('comment_text', 'render_comment', 1);
add_action('comment_text', 'render_comment_code', -1);
?>
