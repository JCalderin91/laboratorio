<template>
	<div v-if="message" class="text-danger">
		<span v-if="typeof message === 'string'">{{ message }}</span>
		<span v-else>{{ message[0] }}</span>
  </div>
</template>

<script>
	// wrench
	// check-double
	export default {
		name: 'message-error',
		props: ['message']
	}
</script>

