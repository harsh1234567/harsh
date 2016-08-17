<?php 
//$url = "http://stackoverflow.com";
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$result = curl_exec($ch);

  // echo $result;

   $sites[0] = 'http://www.traileraddict.com/';

// use this if you want to retrieve more than one page:
// $sites[1] = 'http://www.traileraddict.com/trailers/2';


foreach ($sites as $site)
{
    $ch = curl_init($site);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);


    // ok, you have the whole page in the $html variable
    // now you need to find the common div that contains all the review info
    // and that appears to be <div class="info"> (I think you could use abstract aswell)
    $title_start = '<div class="info">';

    $parts = explode($title_start,$html);

    // now you have an array of the info divs on the page

    foreach($parts as $part){

    // so now you just need to get your title and link from each part

    $link = explode('<a href="/trailer/', $part);

    // this means you now have part of the trailer url, you just need to cut off the end which you don't need:

   $link = explode('">', $link[1]);

   // this should give something of the form:
   // overnight-2012/trailer
   // so just make an absolute url out of it:

   $url = 'http://www.traileraddict.com/trailer/'.$link[0];

  // now for the title we need to follow a similar process:

  $title = explode('<h2>', $part);

  $title = explode('</h2>', $title[1]);

  $title = strip_tags($title[0]);
}}
   ?>