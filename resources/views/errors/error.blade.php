<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Error' }}</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      background-color: #222e3c;
      color: #00ff55;
      font-family: "Courier New", Courier, monospace;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .terminal {
      font-size: 18px;
      color: #00ff55;
      white-space: pre;
      line-height: 1.6;
      text-align: left;
      padding: 20px 40px;
      border-left: 4px solid #00ff55;
      box-shadow: inset 0 0 20px rgba(0,255,85,0.15);
    }
    .prompt { color: #00cc44; margin-right: 8px; }
    .cursor {
      display: inline-block;
      width: 10px; height: 20px;
      background-color: #00ff55;
      animation: blink 0.8s infinite;
      vertical-align: bottom;
    }
    @keyframes blink { 0%,50%{opacity:1;} 50.01%,100%{opacity:0;} }
  </style>
</head>
<body>
  <div class="terminal" id="terminal"></div>

  <script>
    const terminal = document.getElementById("terminal");
    const lines = @json($lines ?? []);
    let index = 0, charIndex = 0;
    const typingSpeed = 35;

    function typeLine() {
      if (index < lines.length) {
        const line = lines[index];
        if (charIndex === 0)
          terminal.innerHTML += "<span class='prompt'>server@simti.rsudzm:~$</span> ";
        if (charIndex < line.length) {
          terminal.innerHTML += line.charAt(charIndex);
          charIndex++;
          setTimeout(typeLine, typingSpeed);
        } else {
          terminal.innerHTML += "\n";
          charIndex = 0;
          index++;
          setTimeout(typeLine, 300);
        }
      } else {
        terminal.innerHTML += "<span class='prompt'>server@simti.rsudzm:~$</span> <span class='cursor'></span>";
        document.addEventListener("keydown", e => {
          if (e.key === "Enter") window.location.href = "{{ url('/') }}";
        });
      }
    }

    window.addEventListener("load", () => {
      setTimeout(typeLine, 200);
    });
  </script>
</body>
</html>
