<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>けっか- ひきざんのもんだい（むずかしいレベル）</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
<style>
    /* 正解時のアニメーション */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-30px); }
        60% { transform: translateY(-15px); }
    }
    
    @keyframes shake {
        0%, 100% { transform: rotate(0deg); }
        10%, 30%, 50%, 70%, 90% { transform: rotate(-5deg); }
        20%, 40%, 60%, 80% { transform: rotate(5deg); }
    }
    
    @keyframes fadeInScale {
        0% { opacity: 0; transform: scale(0.5); }
        100% { opacity: 1; transform: scale(1); }
    }
    
    /* 星のアニメーション */
    @keyframes star {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(-200px) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* 紙吹雪のアニメーション */
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0.3;
        }
    }
    
    /* 花火のアニメーション */
    @keyframes firework {
        0% {
            transform: translate(0, 0) scale(0);
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translate(var(--x), var(--y)) scale(1);
            opacity: 0;
        }
    }
    
    .correct-message {
        animation: bounce 1s ease, fadeInScale 0.5s ease;
        font-size: 3em;
        color: #28a745;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .star {
        position: fixed;
        font-size: 2em;
        animation: star 2s ease-out forwards;
        pointer-events: none;
        z-index: 1000;
    }
    
    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        top: -10px;
        z-index: 1000;
        pointer-events: none;
        animation: confetti-fall 3s linear forwards;
    }
    
    .firework-particle {
        position: fixed;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        z-index: 1000;
        pointer-events: none;
        animation: firework 1.5s ease-out forwards;
    }
    
    .super-message {
        animation: shake 0.5s ease, fadeInScale 0.5s ease;
        font-size: 2em;
        color: #ff6b6b;
        font-weight: bold;
        margin-top: 20px;
        text-shadow: 3px 3px 6px rgba(255, 107, 107, 0.5);
    }
    
    .streak-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        margin: 10px 0;
        font-size: 1.2em;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        animation: fadeInScale 0.5s ease;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>けっかはっぴょう</h1>
        <div class="result">
            <p>
                もんだい：{{ $problem->minuend }} - {{ $problem->subtrahend }} = ?
            </p>
            <p>
                あなたのこたえ：<strong>{{ $userAnswer }}</strong>
            </p>
            <p>
                正しいこたえ：<strong>{{ $problem->answer }}</strong>
            </p>
            <p>
                @if($isCorrect)
                    <span class="correct-message">せいかい！</span>
                    @if($correctStreak >= 5)
                        <div class="super-message">
                            🎉 すごい！{{ $correctStreak }}もんれんぞくせいかい！ 🎉
                        </div>
                        <div class="streak-badge">
                            🏆 れんぞく {{ $correctStreak }}もん 🏆
                        </div>
                    @elseif($correctStreak >= 3)
                        <div class="streak-badge">
                            ⭐ れんぞく {{ $correctStreak }}もん ⭐
                        </div>
                    @endif
                @else
                    <span style="color:red; font-weight:bold;">ざんねん…もういちどチャレンジ！</span>
                @endif
            </p>
        </div>
        <a href="/advanced" class="next-btn">つぎのもんだいへ</a>
        <a href="/advanced/history" class="history-btn">これまでのけっかをみる</a>
    </div>

    @if($isCorrect)
    <script>
        // 通常の正解アニメーション（星）
        function createStars() {
            for (let i = 0; i < 15; i++) {
                setTimeout(() => {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.textContent = ['⭐', '✨', '🌟'][Math.floor(Math.random() * 3)];
                    star.style.left = Math.random() * window.innerWidth + 'px';
                    star.style.top = Math.random() * window.innerHeight / 2 + 'px';
                    star.style.animationDelay = Math.random() * 0.5 + 's';
                    document.body.appendChild(star);
                    setTimeout(() => star.remove(), 2000);
                }, i * 100);
            }
        }

        // 5問連続正解の豪華なアニメーション
        function createSuperAnimation() {
            // カラフルな紙吹雪
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7', '#a29bfe', '#fd79a8'];
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * window.innerWidth + 'px';
                    confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    confetti.style.animationDelay = Math.random() * 0.5 + 's';
                    document.body.appendChild(confetti);
                    setTimeout(() => confetti.remove(), 4000);
                }, i * 30);
            }

            // 花火エフェクト
            setTimeout(() => {
                for (let i = 0; i < 3; i++) {
                    setTimeout(() => {
                        createFirework(
                            Math.random() * window.innerWidth,
                            Math.random() * window.innerHeight / 2 + 100
                        );
                    }, i * 400);
                }
            }, 300);
        }

        function createFirework(x, y) {
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7', '#fd79a8', '#feca57'];
            const particles = 30;
            
            for (let i = 0; i < particles; i++) {
                const particle = document.createElement('div');
                particle.className = 'firework-particle';
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                
                const angle = (Math.PI * 2 * i) / particles;
                const velocity = 50 + Math.random() * 100;
                const xVel = Math.cos(angle) * velocity;
                const yVel = Math.sin(angle) * velocity;
                
                particle.style.setProperty('--x', xVel + 'px');
                particle.style.setProperty('--y', yVel + 'px');
                
                document.body.appendChild(particle);
                setTimeout(() => particle.remove(), 1500);
            }
        }

        // 正解時のアニメーション実行
        @if($correctStreak >= 5)
            createSuperAnimation();
        @else
            createStars();
        @endif

        // 効果音（オプション：ブラウザがサポートしている場合）
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        function playSound(frequency, duration) {
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            oscillator.frequency.value = frequency;
            oscillator.type = 'sine';
            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration);
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + duration);
        }
        
        @if($correctStreak >= 5)
            // 豪華な音
            playSound(523.25, 0.2); // C
            setTimeout(() => playSound(659.25, 0.2), 100); // E
            setTimeout(() => playSound(783.99, 0.3), 200); // G
        @else
            // 通常の正解音
            playSound(523.25, 0.15);
            setTimeout(() => playSound(659.25, 0.15), 100);
        @endif
    </script>
    @endif
</body>
</html>
