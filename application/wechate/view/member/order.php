{extend name="base/base" /}
{block name="content"}
<table class="table table-striped">
    <tr>
        <th>购买商家</th>
        <th>订单号</th>
        <th>电话</th>
        <th>收货人姓名</th>
        <th>状态</th>
    </tr>
    {volist name="orders" id="order" }
    <tr>
        <td>{$order.shop_id}</td>
        <td>{$order.order_code}</td>
        <td>{$order.tel}</td>
        <td>{$order.name}</td>
        <td>{$order.status}</td>
    </tr>
    {/volist}

</table>
{/block}