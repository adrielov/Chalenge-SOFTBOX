<div style="padding-top:10px">

    <div class="col s6">
        <div class="box p-a panel">
            <div class="pull-left m-r">
                <span class="w-48 rounded  success">
                    <i class="material-icons">trending_up</i>
                </span>
            </div>
          <div class="clear">
                <h4 class="m-a-0 text-lg _300"><a href="/releases"><span class="text-sm">R$ </span><?php echo $this->get("total_recipe"); ?></a></h4>
                <small class="text-muted " style="font-size:11pt">Total em receitas.</small>
            </div>
        </div>
    </div>


    <div class="col s6">
        <div class="box p-a panel">
            <div class="pull-left m-r">
                <span class="w-48 rounded  danger">
                    <i class="material-icons">trending_down</i>
                </span>
            </div>
          <div class="clear">
                <h4 class="m-a-0 text-lg _300"><a href="/category"><span class="text-sm">R$ </span><?php echo $this->get("total_expense"); ?></a></h4>
                <small class="text-muted " style="font-size:11pt">Total em despesas.</small>
            </div>
        </div>
    </div>
</div>




