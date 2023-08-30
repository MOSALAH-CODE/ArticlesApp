</div>

</content>

<script>
    const switchButton = document.getElementById('switch-button');
    const switchSpan = document.getElementById('switch-span');

    let isSwitchEnabled = false;

    switchButton.addEventListener('click', () => {
        isSwitchEnabled = !isSwitchEnabled;
        switchButton.setAttribute('aria-checked', isSwitchEnabled.toString());

        if (isSwitchEnabled) {
            switchButton.classList.remove('bg-gray-200');
            switchButton.classList.add('bg-indigo-600');

            switchSpan.classList.add('translate-x-8');
            switchSpan.classList.remove('translate-x-4');
        } else {
            switchButton.classList.remove('bg-indigo-600');
            switchButton.classList.add('bg-gray-200');

            switchSpan.classList.add('translate-x-4');
            switchSpan.classList.remove('translate-x-8');
        }
    });
</script>



</body>
</html>