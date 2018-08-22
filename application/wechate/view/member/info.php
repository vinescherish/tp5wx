{extend name="base/base" /}
{block name="content"}
<table class="table table-striped">
    <tr>
        <th>用户名</th>
        <th>电话</th>
        <th>账户金额</th>
        <th>积分</th>
    </tr>
    <tr>
        <td>{$user.username}</td>
        <td>{$user.tel}</td>
        <td>{$user.money}</td>
        <td>{$user.jifen}</td>
    </tr>
</table>
{/block}