<?php


class ModuleFactory
{
    /**
     * @return EntityRelationshipModelling
     */
    public function createEntityRelationshipModellingModule() : EntityRelationshipModelling
    {
        return new EntityRelationshipModelling();
    }

    /**
     * @return WebDevelopment
     */
    public function createWebDevelopmentModule() : WebDevelopment
    {
        return new WebDevelopment();
    }

    /**
     * @return DatabaseSystems
     */
    public function createDatabaseSystemsModule() : DatabaseSystems
    {
        return new DatabaseSystems();
    }

    /**
     * @return FirstLevelSupport
     */
    public function createFirstLevelSupportModule() : FirstLevelSupport
    {
        return new FirstLevelSupport();
    }

    /**
     * @return NetworkInfrastructure
     */
    public function createNetworkInfrastructureModule() : NetworkInfrastructure
    {
        return new NetworkInfrastructure();
    }

    /**
     * @return CreditRiskManagement
     */
    public function createCreditRiskManagementModule() : CreditRiskManagement
    {
        return new CreditRiskManagement();
    }

    /**
     * @return EnergyMarkets
     */
    public function createEnergyMarketsModule() : EnergyMarkets
    {
        return new EnergyMarkets();
    }

    /**
     * @return ForeignExchange
     */
    public function createForeignExchangeModule() : ForeignExchange
    {
        return new ForeignExchange();
    }

    /**
     * @return PensionFinance
     */
    public function createPensionFinanceModule() : PensionFinance
    {
        return new PensionFinance();
    }

    /**
     * @return BehaviouralFinance
     */
    public function createBehaviouralFinanceModule() : BehaviouralFinance
    {
        return new BehaviouralFinance();
    }

    /**
     * @return ColloquialEnglish
     */
    public function createColloquialEnglishModule() : ColloquialEnglish
    {
        return new ColloquialEnglish();
    }
}
