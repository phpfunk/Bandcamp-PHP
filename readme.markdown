### Description
Really simple Bandcamp API client.

### Requirements
PHP 5+, json_decode(), Bandcamp API Key

### API Documentation
[http://bandcamptech.wordpress.com/2010/05/15/bandcamp-api/](http://bandcamptech.wordpress.com/2010/05/15/bandcamp-api/)

### Methods
1. get

### Get Band
    $bandcamp = new Bandcamp('YOUR KEY');
    $band = $bandcamp->get('band','BAND ID || BAND URL');
    
### Get Discograpy
    $bandcamp = new Bandcamp('YOUR KEY');
    $discography = $bandcamp->get('discography','BAND ID || BAND URL');
    
### Get Album
    $bandcamp = new Bandcamp('YOUR KEY');
    $album = $bandcamp->get('album','ALBUM ID');
    
### Get Track
    $bandcamp = new Bandcamp('YOUR KEY');
    $track = $bandcamp->get('track','TRACK ID');