@include('errors.error', [ 
  'title' => '429 | Too Many Requests',
  'lines' => [
    "Error! 429",
    "Too Many Requests",
    "You are sending requests too fast.",
    "Please wait a few seconds before retrying.",
    "Press [Enter] key to return to dashboard..."
  ]
])
