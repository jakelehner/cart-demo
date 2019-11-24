<template>
    <md-list-item>
      <md-icon class="md-accent">whatshot</md-icon>

        <div class="md-list-item-text">
          <span>{{item.displayName}}</span>
          <span>{{item.sku}} - {{item.quantity}}</span>
        </div>

        <md-button class="md-raised md-accent">
          <md-icon>minus</md-icon> Remove
        </md-button>
      </md-list-item>
</template>

<script>

export default {
  name: 'CartItem',
  props: {
    item: Object
  },
  data: function() {
    return {};
  }
}
</script>

<style scoped>

</style>
