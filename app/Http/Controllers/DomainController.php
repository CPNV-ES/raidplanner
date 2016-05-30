<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use Illuminate\Support\Facades\View;

use App\Http\Requests;

class DomainController extends Controller
{
  protected $server = null;
  protected $server_slug = null;

  public function __construct(Request $request)
  {
    $this->server_slug = $request->subdomain;
    View::share('subdomain', $this->server_slug);
  }

  protected function server(){
    if(!$this->server) {
      $this->server = Server::where('slug', $this->server_slug)->firstOrFail();
    }
    return $this->server;
  }
}
