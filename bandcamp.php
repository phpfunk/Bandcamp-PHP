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
  
  public function get($method='band', $id=3463798201)
  {
    if (array_key_exists($method, $this->methods)) {
      $args = explode('/', $this->methods[$method]);
      $args = $args[0];
      $args .= (is_numeric($id)) ? '_id' : '_url';
      $args .= '=' . $id;
      $args .= (! empty($this->debug)) ? '&debug=1' : '';
      return json_decode(file_get_contents($this->api_url . $this->methods[$method] . '?key=' . $this->api_key . '&' . $args));
    }
    
    return false;
  }
  
}