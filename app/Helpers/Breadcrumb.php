<?php
//app/Helpers/Breadcrumb.php
namespace App\Helpers;

use Illuminate\Http\Request;
 
 
class Breadcrumb {
    /**
     *
     * 
     * @return string
     */
    public static function getBreadcrumb() 
    {
        $router = app()->make('router');
        $uri = $router->getCurrentRoute()->uri;

        $bc = collect([ strtok($uri, '/') => strtok($uri, '/'), strtok('/') => strtok($uri, '/').'/'.strtok('/'), strtok('/') => strtok($uri, '/').'/'.strtok('/').'/'.strtok('/'), strtok('/') => strtok($uri, '/').'/'.strtok('/').'/'.strtok('/').'/'.strtok('/'), strtok('/') => strtok($uri, '/').'/'.strtok('/').'/'.strtok('/').'/'.strtok('/').'/'.strtok('/') ]);

        array_pull($bc, 0);
		

		return $bc;

					
		/*		<ol class="breadcrumb">
					<li><a href="/'.$value.'">'.$key.'</a></li>
			        <li><a href="#">Library</a></li>
				  	<li class="active">Data</li>
			  	</ol>
        */


    }
}