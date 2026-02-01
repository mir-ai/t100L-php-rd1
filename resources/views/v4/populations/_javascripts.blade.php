{{-- PopulationV4Controller.php --}}

{{-- 人口用の追加JS --}}
<script type="module">
  $(function() {
    // 削除ボタン押下時の確認ダイアログ
    $('#exec_destroy').click(function() {

      ret = confirm("人口「{{ $population->ItemTitle ?? '' }}」を削除してよろしいですか？");
      if (ret == false) {
        return false;
      }
    });
  });
</script>
