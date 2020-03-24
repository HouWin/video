<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @SWG\Swagger(
 *     basePath="/",
 *     host="域名",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="xxx API",
 *         description="xxx  API 1.0 Specification",
 *         termsOfService="/",
 *         @SWG\Contact(name="xxx API Team"),
 *         @SWG\License(name="MIT")
 *     ),
 *     @SWG\Definition(
 *         definition="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

class SwaggerController extends Controller
{
    //

    public function doc()
    {


        $swagger = \Swagger\scan(app_path('Http/Controllers/'));
        return response()->json($swagger, 200);
    }
}
