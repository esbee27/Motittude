document.addEventListener('DOMContentLoaded', function() {
    let duration = window.quizDuration || 60; // use global variable injected from Blade

    const timerDisplay = document.createElement('div');
    timerDisplay.id = 'countdown';
    timerDisplay.style.color = 'black';    
    timerDisplay.style.fontWeight = 'bold';
    timerDisplay.style.margin = '10px 0';
    document.querySelector('.quiz-container').prepend(timerDisplay);

    function updateTimer() {
        const minutes = Math.floor(duration / 60);
        const seconds = duration % 60;
        timerDisplay.textContent = `⏰ Time left: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        if (duration > 0) {
            duration--;
            setTimeout(updateTimer, 1000);
        } else {
            alert('⏰ Time is up! Submitting your answer...');
            document.getElementById('quiz_fom').submit();
        }
    }

    updateTimer();
});
