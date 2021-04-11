<footer>
   Developed with ❤ by <a href="https://alemran.me">AL EMRAN</a>
</footer>

<script src="assets/index.js"></script>

<?php

if(sessionFlash('message')){

    ?>
<script>
    webToast.Info({
        status:'Attention !',
        message:"<?php echo sessionFlash('message'); ?>"
    });

</script>

<?php }  ?>



</body>
</html>

