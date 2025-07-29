 function agentFilter({agents : []}) {
  alert(JSON.stringify(agents));
    return {
        agents: agents,
        selectedAgents: [],
        searchQuery: '',
        open: false,
        
        get filteredAgents() {
            if (!this.searchQuery.trim()) return this.agents;
            const query = this.searchQuery.toLowerCase();
            return this.agents.filter(agent => 
                !this.selectedAgents.includes(agent.id) &&
                (
                    agent.firstName.toLowerCase().includes(query) ||
                    agent.lastName.toLowerCase().includes(query) ||
                    (agent.department?.name.toLowerCase().includes(query) ?? false)
                )
            );
        },
        
        toggleAgentSelection(id) {
            if (this.selectedAgents.includes(id)) {
                this.selectedAgents = this.selectedAgents.filter(agentId => agentId !== id);
            } else {
                this.selectedAgents.push(id);
            }
        },
        
        removeAgent(id) {
            this.selectedAgents = this.selectedAgents.filter(agentId => agentId !== id);
        },
        
        getAgentName(id) {
            const agent = this.agents.find(a => a.id === id);
            return agent ? `${agent.firstName} ${agent.lastName}` : '';
        }
    };
}
