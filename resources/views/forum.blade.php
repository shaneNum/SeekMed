<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Forum - SeekMed</title>
    @vite('resources/css/forum.css')
</head>
<body>
    <header>
        <div class="header-top">
            <h1>SeekMed</h1>
            <nav class="top-nav desktop-nav">
                <a href={{route('home')}}"><span>Home</span></a>
                <a href={{route('dashboard')}}"><span>Dashboard</span></a>
                <span class="active">Forum</span>
            </nav>
        </div>
    </header>

    <main class="forum-container">
        <div class="forum-list">
            <div class="forum-card">
                <div class="forum-header">
                    <div class="avatar"></div>
                    <div class="forum-content">
                        <h3>Forum Header</h3>
                        <div class="forum-info">
                            <div class="timestamp">Time</div>
                            <div class="tag">#Tags</div>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($forumPost) === 0)
            <p>No forum posts yet.</p>
            @endif
        </div>
    </main>

</body>
</html>