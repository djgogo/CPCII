<?php


class ModuleFactory
{
    /**
     * @param Lecturer $lecturer
     * @return EntityRelationshipModelling
     */
    public function createEntityRelationshipModellingModule(Lecturer $lecturer) : EntityRelationshipModelling
    {
        return new EntityRelationshipModelling($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return WebDevelopment
     */
    public function createWebDevelopmentModule(Lecturer $lecturer) : WebDevelopment
    {
        return new WebDevelopment($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return DatabaseSystems
     */
    public function createDatabaseSystemsModule(Lecturer $lecturer) : DatabaseSystems
    {
        return new DatabaseSystems($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return FirstLevelSupport
     */
    public function createFirstLevelSupportModule(Lecturer $lecturer) : FirstLevelSupport
    {
        return new FirstLevelSupport($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return NetworkInfrastructure
     */
    public function createNetworkInfrastructureModule(Lecturer $lecturer) : NetworkInfrastructure
    {
        return new NetworkInfrastructure($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return CreditRiskManagement
     */
    public function createCreditRiskManagementModule(Lecturer $lecturer) : CreditRiskManagement
    {
        return new CreditRiskManagement($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return EnergyMarkets
     */
    public function createEnergyMarketsModule(Lecturer $lecturer) : EnergyMarkets
    {
        return new EnergyMarkets($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return ForeignExchange
     */
    public function createForeignExchangeModule(Lecturer $lecturer) : ForeignExchange
    {
        return new ForeignExchange($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return PensionFinance
     */
    public function createPensionFinanceModule(Lecturer $lecturer) : PensionFinance
    {
        return new PensionFinance($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return BehaviouralFinance
     */
    public function createBehaviouralFinanceModule(Lecturer $lecturer) : BehaviouralFinance
    {
        return new BehaviouralFinance($lecturer);
    }

    /**
     * @param Lecturer $lecturer
     * @return ColloquialEnglish
     */
    public function createColloquialEnglishModule(Lecturer $lecturer) : ColloquialEnglish
    {
        return new ColloquialEnglish($lecturer);
    }
}
