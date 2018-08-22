{extend name="base/base" /}
{block name="content"}

{if condition="$bind===null"}<form method="post" action="" enctype="multipart/form-data">

    <div class="form-group">
        <label for="exampleInputEmail1">账号</label>
        <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">确定绑定</button>
</form>
{else /} <a class="btn btn-info" href="{:url('kill')}">解除绑定</a>
{/if}

{/block}