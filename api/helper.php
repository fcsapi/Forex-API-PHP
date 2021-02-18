<?php


function fcs_curl($url, $post){
	// create curl resource
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, $url);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // post parameters 
    if(!empty($post)){
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = is_array($post) ? http_build_query($post) : $post;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    // $output contains the output string
    $output = curl_exec($ch);
    // close curl resource to free up system resources
    curl_close($ch); 
    return $output;
}

