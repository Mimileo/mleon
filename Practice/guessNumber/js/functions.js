 // Your Javascript goes here
            var randomNumber = Math.floor(Math.random() * 99) + 1;
            var guesses = document.querySelector('#guesses');
            var lastResult = document.querySelector('#lastResult');
            var lowOrHi = document.querySelector('#lowOrHi');
            
            var guessSubmit = document.querySelector('.guessSubmit');
            var guessField = document.querySelector('.guessField');
            
            var guessCount = 1;
            var resetButton;
            guessField.focus();
            resetButton = document.querySelector('#reset');
            resetButton.style.display = 'none';
            
            console.log(randomNumber);
            //document.getElementById("numberToGuess").innerHTML = randomNumber;
            
            var resetButton;
            
            function checkGuess() {
                //alert('I am a placeholder');
                var userGuess = Number(guessField.value);
                if (guessCount == 1) {
                    guesses.innerHTML = 'Previous guesses: ';
                }
                guesses.innerHTML += userGuess + ' ';
                
                    if (userGuess == randomNumber) {
                        lastResult.innerHTML = 'Congratulations! You got it right!';
                        lastResult.style.backgroundColor = 'green';
                        lowOrHi.innerHTML = '';
                        setGameOver();
                    } else if (guessCount == 7) {
                        lastResult.innerHTML = 'Sorry, you lost!';
                        setGameOver();
                    } else {
                        lastResult.innerHTML = 'Wrong!';
                        lastResult.style.backgroundColor = 'red';
                        if (userGuess < randomNumber) {
                            lowOrHi.innerHTML = 'Last guess was too low!';
                        } else if (userGuess > randomNumber) {
                            lowOrHi.innerHTML = 'Last guess was too high!';
                        }
                    }
                    
                    guessCount++;
                    guessField.value = '';
                    guessField.focus();
            }
            
            guessSubmit.addEventListener('click', checkGuess);
        
        
            function setGameOver() {
                guessField.disabled = true;
                guessSubmit.diasabled = true;
                resetButton.style.display = 'inline';
                
                resetButton.addEventListener('click', resetGame)
            }
            
            function resetGame() {
                guessCount = 1;
                
                var resetParas = document.querySelectorAll('.resultParas p');
                for(var i = 0; i < resetParas.length; i++) {
                    resetParas[i].textContent = '';
                }
                
                resetButton.style.display = 'none';
                
                guessField.disabled = false;
                guessSubmit.disabled = false;
                guessField='';
                guessField.focus();
                
                lastResult.style.backgroundColor = 'white';
                
                randomNumber = Math.floor(Math.random() * 99) + 1;
            }