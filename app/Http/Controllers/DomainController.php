<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;

use App\Http\Requests;

class DomainController extends Controller
{
  protected $server = null;

  public function __construct(Request $request)
  {
    if (isset($request->subdomain)) $this->server = Server::where('slug', $request->subdomain)->firstOrFail();
  }
}
