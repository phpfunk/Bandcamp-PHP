<?
class Bandcamp {

  public $api_key = NULL;
  public $api_url = 'http://api.bandcamp.com/api/';
  public $debug   = 0;
  
  protected $methods = array();
  
  public function __construct($api_key=NULL, $debug=0)
  {
    $this->api_key = (! empty($api_key)) ? $api_key : $this->api_key;
    $this->debug = (! empty($this->debug)) ? $debug : $this->debug;
    
    $this->methods = array(
      'album'       =>  'album/1/info',
      'band'        =>  'band/1/info',
      'discography' =>  'band/1/discography',
      'track'       =>  'track/1/info'
    );
  }
  
  protected function convert_time($sec)
  {
    if ($sec < 60) {
      return '0:' . $this->format_num($sec);
    }

    $seconds = $sec % 60;
    $minutes = floor($sec / 60);
    if ($minutes < 60) {
      return $minutes . ':' . $this->format_num($seconds);
    }
    
    return floor($sec / 360) . ':' . $this->format_num($minutes) . ':' . $this->format_num($seconds);
  }
  
  protected function format_num($n)
  {
    return ($n < 10) ? '0' . $n : $n;
  }
  
  public function get($method='band', $id=3463798201)
  {
    if (array_key_exists($method, $this->methods)) {
      $args = explode('/', $this->methods[$method]);
      $args = $args[0];
      $args .= (is_numeric($id)) ? '_id' : '_url';
      $args .= '=' . $id;
      $args .= (! empty($this->debug)) ? '&debug=1' : '';
      return (array) json_decode(file_get_contents($this->api_url . $this->methods[$method] . '?key=' . $this->api_key . '&' . $args));
    }
    
    return false;
  }
  
  public function get_all($band_id=3463798201)
  {
    $info = array();
    $info = array_merge($this->get('band', $band_id), $this->get('discography', $band_id));
    
    foreach ($info['discography'] as $k => $obj) {
      $info['discography'][$k] = (array) $obj;
      $album = $this->get('album', $info['discography'][$k]['album_id']);
      foreach ($album as $key => $details) {
        
        if ($key != 'band_id') {
          $info['discography'][$k][$key] = $details;
          if ($key == 'tracks') {
            foreach ($info['discography'][$k][$key] as $track_key => $track_obj) {
              $info['discography'][$k][$key][$track_key] = (array) $track_obj;
              $info['discography'][$k][$key][$track_key]['url'] = $info['url'] . $track_obj->url;
              unset($info['discography'][$k][$key][$track_key]['band_id']);
              unset($info['discography'][$k][$key][$track_key]['album_id']);
              
              if ($track_key == 'duration') {
                $info['discography'][$k][$key][$track_key]['duration_formatted'] = $this->convert_time($track_obj->duration);
              }
            }
          }
        }
      }
      
      $info['discography'][$k]['release_date_formatted'] = date('m/d/Y', $info['discography'][$k]['release_date']);
    }
    return $info;
  }
  
}