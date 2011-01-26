### Description
Really simple Bandcamp API client.

### Requirements
PHP 5+, json_decode(), Bandcamp API Key

### API Documentation
[http://bandcamptech.wordpress.com/2010/05/15/bandcamp-api/](http://bandcamptech.wordpress.com/2010/05/15/bandcamp-api/)

### Methods
1. convert_time (protected)
2. format_num (protected)
3. get (public)
4. get_all (public)

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
    
### Get All - This will return everything formatted as an array with add-ons (release_date_formatted & duration_formatted)
    $bandcamp = new Bandcamp('YOUR KEY');
    $info = $bandcamp->get_all('BAND ID || BAND URL');