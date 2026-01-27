<x-form.open :action="$next" method="POST" class="border-0" />
<div class="row mb-3">
  <div class="col-sm-6">
    <a href="{{ $back }}" class="btn btn-outline-primary form-control mb-3">再アップロード</a>
  </div>
  <div class="col-sm-6">
    <x-input.submit label="保存する" class="btn btn-success form-control mb-3" />
  </div>
</div>
</form>
