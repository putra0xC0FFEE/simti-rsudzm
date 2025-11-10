@include('errors.error', [ 
  'title' => '504 | Gateway Timeout',
  'lines' => [
    "Error! 504",
    "Gateway Timeout",
    "The upstream server failed to send a timely response.",
    "Please try again later.",
    "Press [Enter] key to return to dashboard..."
  ]
])
