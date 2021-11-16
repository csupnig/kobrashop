<?php
if (merx()->cart()->isEmpty()) {
  go('/');
}
if (kirby()->request()->method() === 'POST') {
  try {

    go('https://www.google.com');
  } catch (Exception $ex) {

    echo $ex->getMessage();
    dump($ex->getDetails());
  }
}
