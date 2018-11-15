  <?php

namespace App\Http\Middleware;

// use App\Overlay;
// use App\Campaign;
use DB;
use Closure;
use Illuminate\Support\Facades\Route;

class RedirectCrawlers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $crawlers = [
            'facebookexternalhit/1.1',
            'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
            'Facebot',
            'Twitterbot',
        ];

        $userAgent = $request->header('User-Agent');

        if (str_contains($userAgent, $crawlers)) {
        $overlay=DB::table('overlay')->where('active','1')->where('handle',$request->handle)->get();
        $campaign_data=DB::table('campaign')->where('id',$overlay[0]->campaign_id)->get();;
        return view('overlay/handle',['campaign'=>$overlay[0],'campaign_data'=>$campaign_data[0]]);
        }
        return $next($request);
    }
}