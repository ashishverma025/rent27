<?php

namespace App\Http\Middleware;
use Closure;
use App\TrustswiftlyDocverification;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

class CheckDocVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::id()) {
            $userId = getUser_Detail_ByParam('id');
            $trustUserData = TrustswiftlyDocverification::where('user_id', $userId)->first();
            $segment1 =  $request->segment(1);

            if (empty($trustUserData->docverifyresponse_data)) {
                // if ($segment1 != 'document-verification') {
                //     return redirect('document-verification');
                // }
                return $next($request);
            }else{
                $verificationsData = json_decode($trustUserData->docverifyresponse_data)->verifications;
                $isFailed = 0;
                foreach ($verificationsData as $key => $value) {
                    $status = isset($value->status) ? $value->status : "";
                    if($status->friendly != 'Complete'){
                        $isFailed += 1;
                    }
                }
                // prd( $isFailed);
                if($isFailed == 0){
                    // if ($segment1 != 'profile') {
                    //     return redirect('profile');
                    // }
                    return $next($request);
                }else{
                    // if ($segment1 != 'document-verification') {
                    //     return redirect('document-verification');
                    // }
                    return $next($request);
                }
            }
        }
        return $next($request);
    }
}

