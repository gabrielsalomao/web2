</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').formSelect();
    });

    axios.get('teste.php').then((response) => {
        console.log(response);
    }).catch((error) => {

    });
</script>
</body>

</html>