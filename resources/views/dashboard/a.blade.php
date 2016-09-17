 <sript type"text/javascript">
  function setTime()
        {
           ++totalSeconds;
            if(totalSeconds == 120 && alert_prompt == false){
              var answer = confirm('Your time is up. do you want to continue?');
                  if (answer)
                  {
                    console.log('yes');
                      //alert('Time is about to run out.');
                    $('.alert_label').show();
                    alert_prompt = true;
                  }
                  else
                  {
                    console.log('no');
                    clearTimeout(timeout);
                    next_queue();
                     $('.alert_label').show();
                    alert_prompt = true;
                    return;
                  }
            }
            
        }

        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
      </script>
