<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='glyphicon glyphicon-th-list'></i> 绑定用户列表
        <div class='panel-tools'>

            <div class='btn-group'>
                <?php aci_ui_a($folder_name, 'Bduser', 'add', '', ' class="btn  btn-sm "', '<span class="glyphicon glyphicon-plus"></span> 添加') ?>
            </div>
            <div class='badge'><?php echo count($data_list) ?></div>
        </div>
    </div>
    <div class='panel-filter '>
        <form class="form-inline" role="form" method="get">
            <div class="form-group">
                <label for="keyword" class="form-control-static control-label">关键词</label>
                <input class="form-control" type="text" name="keyword" value="" id="keyword"
                       placeholder="请输入关键词"/></div>
            <button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i
                    class="glyphicon glyphicon-search"></i></button>
        </form>
    </div>

    <div class='panel-body '>


        <table class="table table-hover dataTable">
            <thead>
            <tr>
                <th>#</th>
                <th>姓名</th>
                <th>公司</th>
                <th>手机号</th>
                <th>openid</th>
                <th>总时长</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data_list as $k => $v): ?>
            <tr>

                <td><input type="checkbox" name="pid[]" value="001"/></td>
                <td><?php echo $v['mems_name'] ?></td>
                <td><?php echo $v['mems_company'] ?></td>
                <td><?php echo $v['mems_phone'] ?></td>
                <td><?php echo $v['mems_openid'] ?></td>
                <td><?php echo $v['mems_totaltime'] ?></td>
                <td>
                  <?php aci_ui_a($folder_name, 'user', 'edit', $v['mem_id'], ' class="btn btn-default btn-xs"', '<span class="glyphicon glyphicon-edit"></span> 修改') ?>
                </td>

            </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
    </div>



</div>
</div>


<script language="javascript" type="text/javascript">
    var folder_name = "<?php echo $folder_name?>";
    require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
        require(['<?php echo SITE_URL?>scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']);
    });
</script>
