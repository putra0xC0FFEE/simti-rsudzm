@include('errors.error', [ 
  'title' => '419 | Session Expired',
  'lines' => [
    "Error! 419",
    "Session Expired",
    "Your session has expired or CSRF token is invalid.",
    "Please refresh the page and try again.",
    "Press [Enter] key to return to login..."
  ]
])
