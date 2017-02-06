<template>
  <div class="api_wrap">
    <table class="ui table celled">
      <thead>
        <tr>
          <th>title</th>
          <th>type</th>
          <th>url</th>
          <th>params</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>获取投票信息</td>
          <td>get</td>
          <td>/api/bxjk/vote/{voteid}</td>
          <td>voteid: 投票id</td>
        </tr>
        <tr>
          <td>投票</td>
          <td>post</td>
          <td>/api/bxjk/vote/{voteid}</td>
          <td>voteid: 投票id</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default{

  }
</script>

<style>
  .api_wrap{
    margin-bottom:20px;
  }
</style>