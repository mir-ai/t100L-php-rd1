{{-- GomiItemV4Controller.php --}}

{{-- ごみ分別用の追加JS --}}
<script type="module">
  $(function() {
    // 削除ボタン押下時の確認ダイアログ
    $('#exec_destroy').click(function() {

      ret = confirm("ごみ分別「{{ $gomi_item->ItemTitle ?? '' }}」を削除してよろしいですか？");
      if (ret == false) {
        return false;
      }
    });
  });
</script>
