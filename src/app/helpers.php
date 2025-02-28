<?php

if (! function_exists('storage_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function storage_asset($path, $secure = null)
    {
        return app('url')->asset('storage/'.$path, $secure);
    }
}
