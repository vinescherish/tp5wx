<div class="col-md-2">
    <ul id="main-nav" class="main-nav nav nav-tabs nav-stacked" style="">
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-th-large"></i>
                首页
            </a>
        </li>
        <li>
            <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                <i class="glyphicon glyphicon-cog"></i>
                系统管理

                <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
            </a>
            <ul id="systemSetting" class="nav nav-list secondmenu collapse" style="height: 0px;">
                <li><a href="{:url('Admin/index')}"><i class="glyphicon glyphicon-user"></i>&nbsp;用户管理</a></li>
                <li><a href="{:url('Rule/index')}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;权限管理</a></li>
                <li><a href="{:url('Group/index')}"><i class="glyphicon glyphicon-asterisk"></i>&nbsp;角色管理</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-edit"></i>&nbsp;修改密码</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;日志查看</a></li>
            </ul>
        </li>


        <li>
            <a href="#disSetting" class="nav-header collapsed" data-toggle="collapse">
                <i class="glyphicon glyphicon-globe"></i>
                分发配置
                <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
            </a>
            <ul id="disSetting" class="nav nav-list secondmenu collapse">
                <li><a href="#"><i class="glyphicon glyphicon-th-list"></i>&nbsp;分发包配置</a></li>
            </ul>
        </li>

        <li>
            <a href="#dicSetting" class="nav-header collapsed" data-toggle="collapse">
                <i class="glyphicon glyphicon-bold"></i>
                字典配置
                <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
            </a>
            <ul id="dicSetting" class="nav nav-list secondmenu collapse">
                <li><a href="#"><i class="glyphicon glyphicon-text-width"></i>&nbsp;关键字配置</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-fire"></i>
                关于系统
                <span class="badge pull-right">1</span>
            </a>
        </li>

    </ul>
</div>