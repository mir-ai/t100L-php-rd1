{{-- EventV4Controller.php --}}

{{-- イベント用の追加JS --}}
<script type="module">
  $(function() {
    // 削除ボタン押下時の確認ダイアログ
    $('#exec_destroy').click(function() {

      ret = confirm("イベント「{{ $event->ItemTitle ?? '' }}」を削除してよろしいですか？");
      if (ret == false) {
        return false;
      }
    });
  });
</script>
