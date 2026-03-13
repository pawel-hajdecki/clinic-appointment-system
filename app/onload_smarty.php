<?php

/*
 * The script automatically executed when getSmarty() is called for the first time.
 * Use it to setup the engine or pass additional variables that are always needed.
 */
function url($params, $smarty)
{
  $action = '';
  if (isset($params['action'])){
      $action = $params['action'];
      unset($params['action']);
  }
  return \core\Utils::URL($action, $params);
}

function rel_url($params, $smarty)
{
  $action = '';
  if (isset($params['action'])){
      $action = $params['action'];
      unset($params['action']);
  }
  return \core\Utils::relURL($action, $params);
}

function asset_url($params, $smarty)
{
  $path = $params['path'];
  $type = ($params['type'] ?? 'assets').'/';
  if (!isset($path))
      return '';
  if(str_starts_with($path, $type))
      return \core\App::getConf()->app_root . '/' . $path;

  return \core\App::getConf()->app_root . '/' . $type . $path;
}

function lng_user_status($params, $smarty)
{
    $status = $params['status'];
    return \app\services\Lng::getStatusName($status);
}

\core\App::getSmarty()->registerPlugin("function","url", "url");
\core\App::getSmarty()->registerPlugin("function","rel_url", "rel_url");
\core\App::getSmarty()->registerPlugin("function","asset_url", "asset_url");
\core\App::getSmarty()->registerPlugin("function","lng_user_status", "lng_user_status");
#assign variables
#\core\App::getSmarty()->assign('variable',$variable);
